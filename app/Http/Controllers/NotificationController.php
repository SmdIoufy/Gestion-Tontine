<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CustomNotification;
use App\Notifications\CustomNotificationNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification as NotificationFacade;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    public function create()
    {
        $users = User::all();
        Log::info('All Users: ', $users->pluck('id', 'profil')->toArray());

        return view('notifications.create', [
            'users' => $users,
        ]);
    }

    public function index()
        {
            $notifications = Auth::user()
                ->customNotifications()
                ->latest()
                ->paginate(10);

            return view('notifications.index', [
                'notifications' => $notifications,
            ]);
        }

    public function store(Request $request)
        {
            $request->validate([
                'title' => 'required|string|max:255',
                'message' => 'required|string',
                'recipient_type' => 'required|string',
            ]);

            $title = $request->input('title');
            $message = $request->input('message');
            $priority = $request->input('priority', 'low');
            $recipientType = $request->input('recipient_type');
            $recipients = collect();

            switch ($recipientType) {
                case 'specific':
                    $recipients = User::whereIn('id', $request->input('recipients', []))->get();
                    break;

                case 'all_participants':
                    $recipients = User::where('profil', 'PARTICIPANT')->get();
                    break;

                case 'treasurer':
                    $recipients = User::where('profil', 'GERANT')->get();
                    break;

                case 'admin':
                    $recipients = User::where('profil', 'SUPER_ADMIN')->get();
                    break;

                case 'all_users':
                    $recipients = User::all();
                    break;

                default:
                    return redirect()->back()->withErrors(['recipient_type' => 'Type de destinataires non valide.']);
            }
            if ($recipients->isEmpty()) {
                return redirect()->back()->withErrors(['recipients' => 'Aucun destinataire trouvé pour ce type de notification.']);
            }
            $notification = CustomNotification::create([
                'title' => $title,
                'message' => $message,
                'priority' => $priority,
                'sender_id' => Auth::id(),
            ]);

            $notification->recipients()->attach($recipients->pluck('id'));
            NotificationFacade::send($recipients, new CustomNotificationNotification($title, $message));
            return redirect()->route('notifications.index')->with('success', 'Notification envoyée avec succès.');
        }

    public function show(CustomNotification $notification)
    {
        return view('notifications.show', compact('notification'));
    }

    public function markAsRead(CustomNotification $notification)
    {
        $user = Auth::user();
        $user->customNotifications()->updateExistingPivot($notification->id, ['read' => true]);

        return redirect()->route('notifications.index')->with('success', 'Notification marquée comme lue.');
    }

    public function markAllAsRead()
    {
        $user = Auth::user();
        $user->customNotifications()->updateExistingPivot($user->id, ['read' => true]);

        return redirect()->route('notifications.index')->with('success', 'Toutes les notifications ont été marquées comme lues.');
    }

    public function getUnreadNotifications()
    {
        $user = Auth::user();
        $unreadNotifications = $user->customNotifications()->wherePivot('read', false)->latest()->get();

        return view('notifications.unread_notifications', compact('unreadNotifications'));
    }
}
