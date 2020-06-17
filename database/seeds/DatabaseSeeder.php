<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        for ($i=1; $i <= 2; $i++) { 
            DB::table('users')->insert([
                'name' => 'Admin Admin' . $i,
                'email' => 'james' . $i . '@admin.com',
                'password' => Hash::make('123456'), 
                'user_type' => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
        for ($i=1; $i <= 20; $i++) { 
            DB::table('admins')->insert([
                'firstname' => 'James' . $i,
                'lastname' => 'Doe' . $i,
                'email' => 'james' . $i . '@doe.com',
                'password' => Hash::make('123456'), 
                'cin' => chr(rand(65,90)).rand(1000000,900000),
                'phone' => ('0612345678'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }

        for ($i=1; $i <= 20; $i++) { 
            DB::table('teachers')->insert([
                'firstname' => 'Adam ' . $i,
                'lastname' => 'Teacher ' . $i,
                'email' => 'john' . $i . '@doe.com',
                'password' => Hash::make('123456'), 
                'cin' => chr(rand(65,90)).rand(1000000,900000),
                'phone' => ('0612345678'), 
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }

        for ($i=1; $i <= 20; $i++) { 
            DB::table('students')->insert([
                'firstname' => 'John ' . $i,
                'lastname' => 'Smith ' . $i,
                'email' => 'john' . $i . '@doe.com',
                'cne' => chr(rand(65,90)).rand(1000000,900000), 
                'password' => Hash::make('123456'), 
                'phone' => ('0612345678'),
                'filliere' => rand(0, 1) ? 'GI' : 'TM',
                'anneescolaire' => '2019 - 2020',
                'semester' => 'S4',
                'dob' => rand(1,31).'-'.rand(1,12).'-'.rand(1990,2000),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }

        for ($i=1; $i <= 20; $i++) { 
            DB::table('modules')->insert([
                'name' => 'module ' . $i,
                'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry.",

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }

        for ($i=1; $i <= 20; $i++) { 
            DB::table('fillieres')->insert([
                'name' => 'filliere ' . $i,
                'abbreviation' => 'fil '.$i,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }

             for ($i=1; $i <= 20; $i++) { 
            DB::table('departments')->insert([
                'name' => 'department ' . $i,
                'responsable' => 'responsable '. $i,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }

        for ($i=1; $i <= 20; $i++) { 
            DB::table('elements')->insert([
                'professor' => 'Saidi',
                'name' => 'element ' . $i,
                'type' => rand(0 ,1) ?'TD':'TP',
                'start_date' => date('Y-m-d H:i'),
                'end_date' => date('Y-m-d H:i'),
                'total' => rand(1,10),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
        
        for ($i=1; $i <= 20; $i++) { 
            DB::table('attendances')->insert([
                'justification' => rand(0,1)? 'Non' : 'Oui',
                'hours' => rand(2,4),   
                'type' => rand(0 , 1) ? 'retard' : 'maladie',
                 'date' => date("Y-m-d H:i:s" , rand(1577840511,1606784511)),
                 'element_id' => rand(1,20),
                 'student_id' => $i,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}




/*
	/*$table->bigIncrements('id');
            $table->string('justification')->nullable();
            $table->string('hours');
            $table->string('type');
            $table->date('date');
            $table->unsignedBigInteger('module_id');
            $table->unsignedBigInteger('student_id');
            $table->foreign('module_id')->references('id')->on('modules')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->timestamps();




            Schema::create('module_element', function (Blueprint $table) {
            /*$table->id();
            $table->id();
            $table->foreign('element_id')->references('id')->on('elemets')->onDelete('cascade');
            $table->foreign('module_id')->references('id')->on('modules')->onDelete('cascade');
            $table->timestamps();
            $table->timestamps();
        });




            Schema::create('module_filliere', function (Blueprint $table) {
            /*$table->id();
            $table->foreign('filliere_id')->references('id')->on('fillieres')->onDelete('cascade');
            $table->foreign('module_id')->references('id')->on('modules')->onDelete('cascade');
            $table->timestamps();
        });

*/
