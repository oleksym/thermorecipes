<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AlertMessage extends Component
{
    protected $listeners = ['sendAlert' => 'receiveAlert'];

    private function cleanOldAlerts()
    {
        $alerts = collect(
            session()->get('alert-messages')
        )
        ->reject(function ($alert) {
            return $alert['time'] < now()->subSeconds(0);
        });
        session()->put('alert-messages', $alerts);
    }

    public function receiveAlert(string $type, string $message)
    {
        session()->push('alert-messages', ['type' => $type, 'message' => $message, 'time' => now()]);
    }

    public function dehydrate()
    {
        $this->cleanOldAlerts();
    }

    public function render()
    {
        return view('livewire.alert-message');
    }
}
