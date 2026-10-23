<?php

namespace Tests\Feature;

use App\Models\JobCarte;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class JobCarteSoftDeleteTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Schema::dropIfExists('interventions');
        Schema::dropIfExists('job_cartes');

        Schema::create('job_cartes', function (Blueprint $table): void {
            $table->id();
            $table->string('num_job_carte')->unique();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('interventions', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('job_carte_id');
            $table->timestamps();
        });
    }

    protected function tearDown(): void
    {
        Schema::dropIfExists('interventions');
        Schema::dropIfExists('job_cartes');

        parent::tearDown();
    }

    public function test_archiving_hides_job_carte_but_preserves_its_related_history(): void
    {
        $jobCarte = JobCarte::create([
            'num_job_carte' => 'J-TEST-ARCHIVE',
        ]);

        $interventionId = DB::table('interventions')->insertGetId([
            'job_carte_id' => $jobCarte->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $jobCarte->delete();

        $this->assertNull(JobCarte::find($jobCarte->id));
        $this->assertNotNull(JobCarte::withTrashed()->find($jobCarte->id)?->deleted_at);
        $this->assertDatabaseHas('interventions', [
            'id' => $interventionId,
            'job_carte_id' => $jobCarte->id,
        ]);
        $this->assertNotNull(
            JobCarte::withTrashed()->with('intervention')->findOrFail($jobCarte->id)->intervention,
        );
    }
}
