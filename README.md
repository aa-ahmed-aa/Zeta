# Zeta :clock10:
Zeta :clock10: is an offline judge for programming contests :star2:
<br>

![Alt text](https://github.com/aa-ahmed-aa/Zeta/blob/master/screenshots/welcome.PNG "Zeta Login Page")

## :guardsman: Features
- Contestants auto ranking.
- Can add clarifications for problems.
- Auto judging for c/c++ solutions (java comming soon).

## :triangular_flag_on_post: Judging and Ranking
### Judging
after judging a problem the contestant can get one of 4 responses :- <br>
- AC => ACCEPTED
- WA => WRONG ANSWER
- TLE => TIME LIMIT EXCEEDED
- CE => COMPILER ERROR

![Alt text](https://github.com/aa-ahmed-aa/Zeta/blob/master/screenshots/judge.PNG "Judge")

green judge mean it is recommended to use this type of judging for this submmition


- Automatic :vs: Manual Judging
    - Automatic judging
        It will run the contestant solution and compare it with the testcases given to the that problem and respond to the that user submition .<br>
    - Manual Judging
        Adding the response manually to this submition because Sometimes users didn't follow the rules of the contest and read or write from i/o Stream Not File.<br>

### :oncoming_taxi: Ranking
- Submition rank <br>
    Submition are ranked according to time and problem rank so the ranking equation is :- <br>
```php
                                                     Tstart - Tsub
       submition_rank =   problem_rank    -    _________________________    -    ( $wrongAnswerCount * 5 )
                                                           60

       Minimum Submmition Rank is = 40% Of problem rank

```

- User rank <br>
    - Users are ranked according to the highest sum of the ACCEPTED problems rank.
    - Scoreboard Time is the time of the user last submition.

    ![Alt text](https://github.com/aa-ahmed-aa/Zeta/blob/master/screenshots/scoreboard.PNG "Judge")

Time is the Time of the user last Submmition


## PreRequirements
- xampp <br>
    <span style="color: red">if you have any problem with the calss named String it is according to PHP version read this to fix the problem : https://github.com/cakephp/cakephp/issues/7573</span>
- GCC Compiler <br>
    i used <a href="https://nuwen.net/mingw.html" >Mingw</a>

## Installation
- Download the Repo `git clone https://github.com/aa-ahmed-aa/Zeta` or via the download button.
- Import the database file in the `Database/zeta_4.sql` to phpmyadmin.
- Go to `app/Config/database.php` and update username and password to your credential
- Download <a href="https://nuwen.net/mingw.html" >Mingw</a> compiler and copy it to your Zeta path.
- Now Goto <a href="http://localhost/Zeta">http://localhost/Zeta</a> and user username : ahmedkhaled, password : ahmed to login (this is the default admin account you can use it to add other admins and contestant then delete it later)

<span style="font color: red">Before starting a contest you should go to Settings and set the starting time of the contest this time is used to ranks problems and contestant in the scoreboard</span>
## :construction: Contribution & Future work



