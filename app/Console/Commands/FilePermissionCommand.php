<?php

namespace Main\Console\Commands;

use Illuminate\Console\Command;

class FilePermissionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'set-permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set the file permissions';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = config('filesystems.permissions.user');
        $group = config('filesystems.permissions.group');

        $this->call("flatfilecms:set-permissions", ["--user" => $user, "--group" => $group]);
    }
}
