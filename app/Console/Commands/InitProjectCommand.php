<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Process;

class InitProjectCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:init-project-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Init Manage brand project';

    /**
     * @var array|string[]
     */
    private array $needed_programs = [
        'Composer' => 'composer -V',
    ];

    public function handle(): void
    {
        $this->checkIfDependenciesSatisfied()
            ->runComposerInstall()
            ->copyEnv()
            ->runPnpm()
            ->publishStorageFolders()
            ->migrateDatabase()
            ->seedDatabase()
            ->displayResult();
    }

    private function checkIfDependenciesSatisfied(): InitProjectCommand
    {
        $this->info('ℹ️ Checking if all dependencies are satisfied.');
        $missing_dependency = false;

        foreach ($this->needed_programs as $name => $command) {
            $result = Process::run($command);

            if ($result->successful()) {
                $this->info(" ✅ $name is installed");

                continue;
            }

            $missing_dependency = true;
            $this->error(" ❌ $name is not installed or not installed correctly. Please install $name before running this command again.");

        }

        if ($missing_dependency) {
            $this->error('You need to install missing dependency in order to continue.');
            exit(1);
        }

        return $this;
    }

    private function copyEnv(): InitProjectCommand
    {
        $this->newLine();
        $this->info('ℹ️ Checking environment files');

        if (! File::exists(base_path('.env'))) {
            File::copy(base_path('.env.example'), base_path('.env'));
            $this->info(' ✅ .env has been created. You can customize it if needed.');
            Artisan::call('key:generate');
            $this->info(' ✅ Artisan key generate successfully.');
        }

        $this->info(' ✅ Environment files are installed correctly.');

        return $this;
    }

    private function publishStorageFolders(): InitProjectCommand
    {
        $this->newLine();
        $this->info('ℹ️ Publish storage folders "media" and "storage"');

        Artisan::call('storage:link');

        sleep(1);

        return $this;
    }

    private function runComposerInstall(): InitProjectCommand
    {
        $this->newLine();
        $this->info('ℹ️ Installing App php dependencies.');
        $result = Process::run(['composer', 'install']);

        if ($result->successful()) {
            $this->info(' ✅ App php dependencies has been installed properly.');
            $this->info($result->output());
        }

        sleep(1);

        return $this;
    }

    private function runPnpm(): InitProjectCommand
    {
        $this->newLine();
        $this->info('ℹ️ Installing App Node dependencies using pnpm.');

        $result = Process::run('pnpm install');

        if ($result->successful()) {
            $this->info(' ✅ App Node dependencies has been installed properly.');
            $this->info($result->output());
        }

        sleep(1);

        return $this;
    }

    private function migrateDatabase(): InitProjectCommand
    {
        $this->newLine();

        $this->info('ℹ️ Starting migrate and seed tables in database.');

        Artisan::call('migrate');
        Artisan::call('db:seed');

        $this->info(' ✅ migration and seed done properly.');

        sleep(1);

        return $this;
    }

    private function seedDatabase(): InitProjectCommand
    {
        $this->newLine();

        $this->info('ℹ️ Starting to create admin user using Seeder Data.');

        User::query()->create([
            'email' => 'admin@casinoonlinefrancais3.info',
            'name' => 'Admin',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);

        $this->info(' ✅ Admin creation done properly.');

        return $this;
    }

    private function displayResult(): void
    {
        $this->newLine();

        $this->info('🔥 Your project has been initialized properly.');

        $this->newLine(2);
        $this->info('Your project start now! 🚀🚀🚀');
    }
}
