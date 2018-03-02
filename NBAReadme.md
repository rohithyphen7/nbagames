Steps to make project work!
Create .env file, I have put .env.example file in project for reference
you can just remove .example from .env it will work

Open terminal in project folder and run the below commands:

1. php artisan key:generate.
2. Composer instal
3. php artisan create:database //make sure mysql server doesn't have password
4. php artisan migrate
5. php artisan db:seed --class=GroupTableSeeder
6. php artisan db:seed --class=PlayersTableSeeder
7. php artisan db:seed --class=TeamsTableSeeder
8. composer dump -o

Most Important !
To start matches between teams and getting the real time updates run the command no 9 

But firstly open the app and register to enter(just a basic laravel Registration).
click on "on going matches" currently u will see everything is set to zero.

Now open terminal in app folder and run the command given below. ! this will start the matches

9. php artisan start:game

 This command will start all the matches. 
 After running this command open the application, go to the "on going matches" you will see real time
 score card.
 
 If you wish to simulate matches again
 run the command no 9 and all teams are ready for match this time with
 different opponents and after all matches over in 240 seconds teams score charts is updated
 which you can check in "team ranking section".
 
 I also made a button for simulation. I commented it in "teams.blade" file.
 If uncommented, it will work same as command no 9 is working right now.
 But I think we should not allow user to create such activity because 
 on going matches needs to be dynamic activity.
 
 I also made section for Top 20 players in which highest point players are rendered.