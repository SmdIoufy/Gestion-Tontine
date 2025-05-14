<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PayTechService;

class PaymentController extends Controller
{
    protected $payTechService;

    public function __construct(PayTechService $payTechService)
    {
        $this->payTechService = $payTechService;
    }

    /**
     * Afficher la page de paiement
     */
    public function showPaymentPage()
    {
        return view('payments.index');
    }

    /**
     * Créer un paiement via PayTech
     */
    public function createPayment(Request $request)
    {
        $data = $request->validate([
            'item_name' => 'required|string',
            'item_price' => 'required|numeric',
            'currency' => 'required|string', // Ex: "XOF"
            'command_name' => 'required|string',
        ]);

        // Ajoutez les URLs de redirection et les canaux
        $data['notify_url'] = route('payment.notify');
        $data['return_url'] = route('payment.success');
        $data['cancel_url'] = route('payment.cancel');
        $data['channels'] = ['WAVE', 'OM']; // Canaux disponibles : WAVE, OM

        $response = $this->payTechService->createPayment($data);

        if ($response['status'] === 'error') {
            return redirect()->back()->with('error', $response['message']);
        }

        // Redirection vers la page de paiement PayTech
        return redirect()->away($response['redirect_url']);
    }

    /**
     * Notification de paiement (callback PayTech)
     */
    public function handleNotify(Request $request)
    {
        // Vérifiez et traitez la notification
        \Log::info('Notification PayTech reçue', $request->all());
        return response()->json(['message' => 'Notification reçue avec succès.']);
    }

    /**
     * Succès du paiement
     */
    public function handleSuccess()
    {
        return view('payments.success');
    }

    /**
     * Annulation du paiement
     */
    public function handleCancel()
    {
        return view('payments.cancel');
    }
}
