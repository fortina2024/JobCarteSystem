<x-filament-panels::page>
    <div style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
        
        <!-- Bouton d'impression -->
        <div style="margin-bottom: 20px; text-align: right;">
            <button onclick="window.print()" style="background: #2563eb; color: white; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer;">
                🖨️ Imprimer / Enregistrer en PDF
            </button>
        </div>

        <!-- Inclusion du contenu partagé -->
        @include('partials.job-carte-content')

    </div>

    @push('styles')
    <style>
        @media print {
            aside, header, nav, .fi-topbar, .fi-sidebar, button { display: none !important; }
            body { background: white !important; }
        }
    </style>
    @endpush
</x-filament-panels::page>