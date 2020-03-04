<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Attendance;
use Carbon\Carbon;

class RefreshAttendance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:refreshattendance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $refresh_attend = User::where('status', 'Signed In')->update([
            'status' => 'Signed Out',
            'banned_until' => Carbon::now()->addYear(0)->addMonth(0)->addDay(1)->hour(0)->minute(0)->second(0)->toDateTimeString(),
        ]);
        echo "Attendance Refreshed";
    }
}
