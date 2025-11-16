<?php

namespace Syndicate\Architect\Commands;

use Illuminate\Console\Command;
use Syndicate\Architect\Contracts\BlueprintKey;
use Syndicate\Architect\Models\Blueprint;

class ArchitectSeedCommand extends Command
{
    protected $signature = 'syndicate:architect-seed
                            {--key : The key to seed}';

    private int $processed = 0;

    public function handle(): int
    {
        $key = $this->option('key');

        if (!is_subclass_of($key, BlueprintKey::class)) {
            $this->error("{$key} not of type " . BlueprintKey::class);
            return self::FAILURE;
        }

        $this->resetCounters();
        $this->createOrUpdate($key);
        $this->printCounters();

        return self::SUCCESS;
    }

    protected function resetCounters(): void
    {
        $this->processed = 0;
    }

    /**
     * @param class-string<BlueprintKey> $key
     * @return void
     */
    public function createOrUpdate(string $key): void
    {
        foreach ($key::cases() as $case) {
            Blueprint::updateOrCreate([
                'key' => $case->value,
                'type' => $key::getId(),
            ], [
                'title' => $case->name,
                'fqn' => get_class($case),
            ]);

            $this->processed++;
        }
    }

    protected function printCounters(): void
    {
        $this->info("Processed: {$this->processed}");
    }
}
