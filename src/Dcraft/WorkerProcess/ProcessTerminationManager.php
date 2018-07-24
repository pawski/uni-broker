<?php
declare(strict_types=1);

namespace Dcraft\WorkerProcess;

class ProcessTerminationManager
{
    /** @var TerminationInterface[] */
    private $terminationQueue;

    public function appendTermination(TerminationInterface $terminationSubject): void
    {
        $this->terminationQueue[] = $terminationSubject;
    }

    public function runTerminationSequence(): void
    {
        foreach ($this->terminationQueue as $terminationSubject) {
            $terminationSubject->stop();
        }

        exit(0);
    }

    public function init(): void
    {
        register_tick_function(function () {
            pcntl_signal_dispatch();
        });

        declare (ticks = 1);
    }
}
