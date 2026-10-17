<x-filament-panels::page>
    <div style="background: white; padding: 20px; border-radius: 8px;">
        <h1>Test : La page s'affiche !</h1>
        <p>Numéro de Job Carte : {{ $record->num_job_carte ?? 'Aucun record trouvé' }}</p>
    </div>
</x-filament-panels::page>