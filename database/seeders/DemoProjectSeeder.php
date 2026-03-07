<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Project;
use App\Models\ProjectStage;
use Illuminate\Support\Facades\Hash;

class DemoProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. Create a Test Investor Account if it doesn't exist
        $investor = User::firstOrCreate(
        ['email' => 'investor@test.com'],
        [
            'name' => 'John Test Investor',
            'password' => Hash::make('password123'),
            'role' => 'investor'
        ]
        );

        // 2. Create the Test Project
        $project = Project::firstOrCreate(
        ['slug' => 'ai-health-diagnostics-platform'],
        [
            'title' => 'AI Health Diagnostics Engine',
            'description' => 'A revolutionary AI-driven diagnostic platform that uses deep learning to identify anomalies in MRI scans with 99.8% accuracy. We are seeking early-stage investors to help finalize clinical trials and FDA approval.',
            'target_amount' => 500000.00,
            'current_amount' => 125000.00, // 25% funded
            'status' => 'active',
            'image' => null // You can add an image URL if desired
        ]
        );

        // 3. Create Timeline Stages for the Project
        ProjectStage::firstOrCreate(
        ['project_id' => $project->id, 'sort_order' => 1],
        [
            'title' => 'Algorithm Development',
            'description' => 'Initial training and testing of the neural network using open-source datasets.',
            'status' => 'completed'
        ]
        );

        ProjectStage::firstOrCreate(
        ['project_id' => $project->id, 'sort_order' => 2],
        [
            'title' => 'Clinical Trial Phase 1',
            'description' => 'Partnering with 3 local hospitals to run double-blind diagnostic tests on real patient data.',
            'status' => 'in_progress'
        ]
        );

        ProjectStage::firstOrCreate(
        ['project_id' => $project->id, 'sort_order' => 3],
        [
            'title' => 'FDA Submission',
            'description' => 'Compiling trial data and submitting for regulatory approval.',
            'status' => 'pending'
        ]
        );

        // Output to console if running via artisan
        $this->command->info('Test investor and project have been seeded successfully!');
    }
}
