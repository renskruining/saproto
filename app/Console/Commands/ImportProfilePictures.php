<?php

namespace Proto\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

use Proto\Models\StorageEntry;
use Proto\Models\User;

class ImportProfilePictures extends Command
{

    private $laraveldb, $legacydb;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'proto:profilepics';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command imports all existing profile pictures.';

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
     */
    public function handle()
    {
        foreach (User::all() as $user) {
            if ($user->proto_username) {

                $this->info("Trying to download profile picture for " . $user->name . ". (" . $user->proto_username . ")");

                $url = "https://www.saproto.nl/wordpress/wp-content/uploads/userphoto/" . $user->proto_username;
                $headers = get_headers($url);
                if (substr($headers[0], 9, 3) != "200") {
                    $this->error("Could not fetch profile picture for " . $user->name . ".");
                    continue;
                }

                $name = "imported_profile_pics/" . date('U') . "-" . mt_rand(1000, 9999);
                Storage::disk('local')->put($name, file_get_contents($url));

                $file = new StorageEntry();
                $file->mime = "image/jpeg";
                $file->original_filename = $user->proto_username;
                $file->filename = $name;
                $file->save();

                $user->photo()->associate($file);
                $user->save();

                $this->info("Profile picture downloaded for " . $user->name . "!");

            }
        }
    }

}
