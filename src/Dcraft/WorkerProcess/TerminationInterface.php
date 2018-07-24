<?php
namespace Dcraft\WorkerProcess;

interface TerminationInterface
{
    public function stop(): void;
}
