<p>Bonjour {{ $jobCarte->client?->nom ?? 'Client' }},</p>

<p>
    Nous vous informons que la Job Carte n° {{ $jobCarte->num_job_carte }}
    concernant le véhicule {{ $jobCarte->vehicule?->identifiant_vehicule ?? 'concerné' }} a été annulée et archivée.
</p>

<p>La signature précédemment enregistrée reste conservée dans nos archives.</p>

<p>Cordialement,<br>JobCarte Pro</p>