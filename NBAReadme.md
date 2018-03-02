Steps to make project work!
Create .env file, I have put .env.example file in project for reference
Open terminal in project folder and run the below commands:

1. php artisan key:generate.
2. Composer update
3. php artisan create:database
4. php artisan migrate
4. php artisan db:seed --class=GroupTableSeeder
5. php artisan db:seed --class=PlayersTableSeeder
6. php artisan db:seed --class=TeamsTableSeeder
7. composer dump -o

Most Important !
To start matches between teams and getting the real time updates run the command no 8 

But firstly open the app and register to enter.
8. php artisan start:game

 This command will start all the matches. 
 After running this command open the application, go to the "on going matches" you will see real time
 score card.
 
 If you wish to simulate matches again
 run the command no 8 and all teams are ready for match this time with
 different opponents and after all matches over in 240 seconds teams score charts is updated
 which you can check in "team ranking section".
 
 I also made a button for simulation. I commented it in "teams.blade" file.
 If uncommented, it will work same as command no 8 is working right now.
 But I think we should not allow user to create such activity because 
 on going matches needs to be dynamic activity.
 
 I also made section for Top 20 players in which highest point players are rendered.