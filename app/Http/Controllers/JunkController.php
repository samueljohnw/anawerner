<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Course;
use App\Models\Purchase;

class JunkController extends Controller
{

    function read($csvfile = null)  {
        
        $filePath = $csvfile['filepath']; // Adjust path as needed

        // Ensure the file exists
        if (!file_exists($filePath) || !is_readable($filePath)) {
            return response()->json(['error' => 'File not found or not readable'], 404);
        }

        $file = fopen($filePath, 'r');
        $data = [];

        // Read the header row (if present)
        $header = fgetcsv($file);

        // Loop through the rows
        while (($row = fgetcsv($file)) !== false) {
            $data[] = array_combine($header, $row); // Combine header and row for associative array
        }

        fclose($file);

        foreach($data as $point)
        {

            // First Create the User if Doesn't Exists
            // Insert them then verify their email
            $user = User::firstOrCreate(['email' => $point['Email']],
            [    
                'name' => $point['Full Name'],
                'email_verified'=> 1,

            ]);

            // Check if Course exits then create it
            $course = Course::firstOrCreate(
            [   'title' =>  $csvfile['title'],
                'type'  =>  $csvfile['type']
            ],
            [    
                'status' => $csvfile['status'],
                'slug'=> $csvfile['slug'],
                'price' => $csvfile['price']

            ]);

            // create the purchase based on the user_id and course _id
            // declare a purchased at date
            $purchase = new Purchase;
            $purchase->user_id = $user->id;
            $purchase->course_id = $course->id;
            $purchase->purchased_at = $csvfile['purchased_at'];
            $purchase->save();

        }
        // Return the data (or process as needed)
        return response()->json($data);
        

    }

    function courses() {
            
            $march2020 = [
                'title' => 'March 2020',
                'type' => 'seer-school',
                'status' => 'published',
                'slug' => Str::slug('March 2020', '-'),
                'purchased_at' => '2020-03-01',
                'price'=>80.00,
                'filepath'=> '/home/forge/CSV/march-2020.csv'
            ];
    
            $july2020 = [
                'title' => 'July 2020',
                'type' => 'seer-school',
                'status' => 'published',
                'slug' => Str::slug('July 2020', '-'),
                'purchased_at' => '2020-07-01',
                'price'=>80.00,
                'filepath'=> '/home/forge/CSV/july-2020.csv'

            ];        
            $september2020 = [
                'title' => 'September 2020',
                'type' => 'seer-school',
                'status' => 'published',
                'slug' => Str::slug('September 2020', '-'),
                'purchased_at' => '2020-09-01',
                'price'=>80.00,
                'filepath'=> '/home/forge/CSV/september-2020.csv'
            ];          
            $december2020 = [
                'title' => 'December 2020',
                'type' => 'seer-school',
                'status' => 'published',
                'slug' => Str::slug('December 2020', '-'),
                'purchased_at' => '2020-12-01',
                'price'=>80.00,
                'filepath'=> '/home/forge/CSV/december-2020.csv'

            ];   
            
            $may2021 = [
                'title' => 'May 2021',
                'type' => 'seer-school',
                'status' => 'published',
                'slug' => Str::slug('May 2021', '-'),
                'purchased_at' => '2021-5-01',
                'price'=>80.00,
                'filepath'=> '/home/forge/CSV/may-2021.csv'

            ];   
    
            $october2021 = [
                'title' => 'October 2021',
                'type' => 'seer-school',
                'status' => 'published',
                'slug' => Str::slug('October 2021', '-'),
                'purchased_at' => '2021-10-01',
                'price'=>80.00,
                'filepath'=> '/home/forge/CSV/october-2021.csv'

            ]; 
    
            $april2022 = [
                'title' => 'April 2022',
                'type' => 'seer-school',
                'status' => 'published',
                'slug' => Str::slug('April 2022', '-'),
                'purchased_at' => '2022-04-01',
                'price'=>80.00,
                'filepath'=> '/home/forge/CSV/april-2022.csv'

            ]; 
    
            $october2022 = [
                'title' => 'October 2022',
                'type' => 'seer-school',
                'status' => 'published',
                'slug' => Str::slug('October 2022', '-'),
                'purchased_at' => '2022-10-01',
                'price'=>99.00,
                'filepath'=> '/home/forge/CSV/october-2022.csv'

            ]; 
    
            $april2023 = [
                'title' => 'April 2023',
                'type' => 'seer-school',
                'status' => 'published',
                'slug' => Str::slug('April 2023', '-'),
                'purchased_at' => '2023-04-01',
                'price'=>89.00,
                'filepath'=> '/home/forge/CSV/april-2023.csv'

            ]; 
    
            $july2023 = [
                'title' => 'July 2023',
                'type' => 'seer-school',
                'status' => 'published',
                'slug' => Str::slug('July 2023', '-'),
                'purchased_at' => '2023-07-01',
                'price'=>99.00,
                'filepath'=> '/home/forge/CSV/july-2023.csv'

            ]; 
    
            $september2023 = [
                'title' => 'September 2023',
                'type' => 'seer-school',
                'status' => 'published',
                'slug' => Str::slug('September 2023', '-'),
                'purchased_at' => '2023-09-01',
                'price'=>99.00,
                'filepath'=> '/home/forge/CSV/september-2023.csv'

            ]; 
    
            $may2024 = [
                'title' => 'May 2024',
                'type' => 'seer-school',
                'status' => 'published',
                'slug' => Str::slug('May 2024', '-'),
                'purchased_at' => '2024-05-01',
                'price'=>119.00,
                'filepath'=> '/home/forge/CSV/may-2024.csv'

            ]; 
    
            $september2024 = [
                'title' => 'September 2024',
                'type' => 'seer-school',
                'status' => 'published',
                'slug' => Str::slug('September 2024', '-'),
                'purchased_at' => '2024-09-01',
                'price'=>149.00,
                'filepath'=> '/home/forge/CSV/september-2024.csv'

            ]; 
            $healingschool2021 = [
                'title' => 'Healing School 2021',
                'type' => 'healing-school',
                'status' => 'published',
                'slug' => Str::slug('Healing School 2021', '-'),
                'purchased_at' => '2021-01-01',
                'price'=>135.00,
                'filepath'=> '/home/forge/CSV/healingschool-2021.csv'

            ]; 
            $healingschool2022 = [
                'title' => 'Healing School 2022',
                'type' => 'healing-school',
                'status' => 'published',
                'slug' => Str::slug('Healing School 2022', '-'),
                'purchased_at' => '2022-01-01',
                'price'=>125.00,
                'filepath'=> '/home/forge/CSV/healingschool-2022.csv'

            ]; 
            $healingschool2023 = [
                'title' => 'Healing School 2023',
                'type' => 'healing-school',
                'status' => 'published',
                'slug' => Str::slug('Healing School 2023', '-'),
                'purchased_at' => '2023-01-01',
                'price'=>125.00,
                'filepath'=> '/home/forge/CSV/healingschool-2023.csv'

            ]; 
            $healingschool2024 = [
                'title' => 'Healing School 2024',
                'type' => 'healing-school',
                'status' => 'published',
                'slug' => Str::slug('Healing School 2024', '-'),
                'purchased_at' => '2024-01-01',
                'price'=>139.00,
                'filepath'=> '/home/forge/CSV/healingschool-2024.csv'
            ]; 
            $seeranointing = [
                'title' => 'Seer Anointing',
                'type' => 'e-course',
                'status' => 'published',
                'slug' => Str::slug('Seer Anointing', '-'),
                'purchased_at' => '2020-01-01',
                'price'=>55.00,
                'filepath'=> '/home/forge/CSV/seeranointing.csv'
            ]; 

            $childseer = [
                'title' => 'Children Seer Anointing',
                'type' => 'e-course',
                'status' => 'published',
                'slug' => Str::slug('Children Seer Anointing', '-'),
                'purchased_at' => '2024-09-01',
                'price'=>125.00,
                'filepath'=> '/home/forge/CSV/children.csv'
            ]; 


            return [$march2020,$july2020,$september2020,$december2020, $may2021,$october2021,$april2022,$october2022,$april2023,$july2023,$september2023,$may2024,$september2024,$healingschool2021,$healingschool2022,$healingschool2023,$healingschool2024,$seeranointing,$childseer];
    }
}
