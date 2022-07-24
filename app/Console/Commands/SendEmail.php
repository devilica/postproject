<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Log;
use App\Models\User;
use App\Support\DripEmailer;
use App\Mail\MassMail;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a marketing email to a user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function __construct()
    {
        parent::__construct();
    }



    public function handle()
    {

    try{
        $users=User::where('user_type', '=', 'user')->get();

        $details = [
            'title' => 'Veliko sniženje',
            'body' => 'Kupite naš projekat po niskoj cijeni...'
        ];

        foreach($users as $user){
            \Mail::to($user->email)->queue(new MassMail($details));

        }

    }
    catch(Exception $e)
    {
              Log::info($e->getMessage());
    }

    }
       

       


}