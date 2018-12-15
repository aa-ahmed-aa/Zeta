# Zeta :dragon:
Zeta :dragon: is an offline judge for programming contests :trophy:
<br>
<p align="center">
    <img src="https://github.com/aa-ahmed-aa/Zeta/blob/master/screenshots/main.gif" alt="Landing Page" />
</p>
## :guardsman: Features
- Contestants auto ranking.
- Can add clarifications for problems.
- Auto judging for c/c++ solutions (java comming soon).

## :triangular_flag_on_post: Judging and Ranking
#### :pushpin: Judging
after judging a problem the contestant can get one of 4 responses :- <br>
- AC => ACCEPTED
- WA => WRONG ANSWER
- TLE => TIME LIMIT EXCEEDED
- CE => COMPILER ERROR

![Alt text](https://github.com/aa-ahmed-aa/Zeta/blob/master/screenshots/judge.PNG "Judge")

**green judge mean it is recommended to use this type of judging for this submmition**


- Automatic :vs: Manual Judging
    - Automatic judging
        It will run the contestant solution and compare it with the testcases given to that problem and respond to that user submition .<br>
    - Manual Judging
        Adding the response manually to this submition because Sometimes users didn't follow the rules of the contest and read or write from i/o Stream Not File.<br>

#### :oncoming_taxi: Ranking
- Submition rank <br>
    Submition are ranked according to time and problem rank so the ranking equation is :- <br>
```php
                                                     Tstart - Tsub
       submition_rank =   problem_rank    -    _________________________    -    (    wrongAnswerCount   *   5    )
                                                           60

       Minimum Submmition Rank is = 40% Of problem rank

```

- User rank <br>
    - Users are ranked according to the highest sum of the ACCEPTED problems rank.
    - Scoreboard Time is the time of the user last submition.

    ![Alt text](https://github.com/aa-ahmed-aa/Zeta/blob/master/screenshots/scoreboard.PNG "Judge")

    **Time is the Time of the user last Submmition**


## :rocket: PreRequirements
- xampp ( if you have any problem with the calss named String it is according to PHP version read this to fix the problem : https://github.com/cakephp/cakephp/issues/7573 )
- GCC Compiler ( i used <a href="https://nuwen.net/mingw.html" >Mingw</a> )

## :fire: Installation
- Download the Repo `git clone https://github.com/aa-ahmed-aa/Zeta` or via the download button.
- Import the database file in the `Database/zeta_4.sql` to phpmyadmin.
- Go to `app/Config/database.php` and update username and password to your credential
- Download <a href="https://nuwen.net/mingw.html" >Mingw</a> compiler and copy it to your Zeta path.
- Now Goto <a href="http://localhost/Zeta">http://localhost/Zeta</a> and user username : ahmedkhaled, password : ahmedkhaled123 to login (this is the default admin account you can use it to add other admins and contestant then delete it later)

> # Before starting a contest you should go to Settings and set the starting time of the contest this time is used to ranks problems and contestant in the scoreboard

## :construction: Contribution
> Compilation and Running is based on this package (<a href="https://github.com/aa-ahmed-aa/Dorm">DORM</a>) so feel free to have a look.<br>

If you find any problem feel free to open issues with any error you find or features you think we can add to Zeta, if you have any problem while you are installing zeta please feel free to contact me at __ahmedkhaled36@hotmail.com__


## :police_car: License
The MIT License (MIT). Please see [License](https://github.com/aa-ahmed-aa/Dorm/blob/master/LICENSE) File for more information.


