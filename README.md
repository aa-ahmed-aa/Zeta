# Zeta :skull:
Zeta is an offline judge for programming contests :star2:
<br>

![Alt text](https://github.com/aa-ahmed-aa/Zeta-Project/blob/master/screenshots/welcome.PNG "Laura Landing page")

## :guardsman: Features
    - Contestants auto ranking.<br>
    - Can add clarifications for problems.<br>
    - Auto judging for c/c++ solutions (java comming soon).<br>

## :triangular_flag_on_post: Judging and Ranking
### Judging
after judging a problem the contestant can get one of 4 responses :- <br>
- AC => ACCEPTED
- WA => WRONG ANSWER
- TLE => TIME LIMIT EXCEEDED
- CE => COMPILER ERROR

![Alt text](https://github.com/aa-ahmed-aa/Zeta-Project/blob/master/screenshots/judge.PNG "Laura Landing page")

green judge mean it is recommended to use this type of judging for this submmition


- Automatic vS Manual Judging
    - Automatic judging
        It will run the contestant solution and compare it with the testcases given to the that problem and respond to the that user submition .<br>
    - Manual Judging
        Adding the response manually to this submition because Sometimes users didn't follow the rules of the contest and read or write from i/o Stream Not File.<br>

### Ranking
-Submition rank
    Submition are ranked according to time and problem rank so the ranking equation is :- <br>
    ```
                                                         Tstart - Tsub
           submition_rank =   problem_rank    -    _________________________    -    ( $wrongAnswerCount * 5 )
                                                               60

           Minimum Submmition Rank is = 40% Of problem rank

    ```

-User rank
        Users are ranked according to the highest sum of the ACCEPTED problems rank.

## PreRequirements

## Installation

## Contribution & Future work


***if you have any problem with the calss named String it is according to PHP version read this to fix the problem : https://github.com/cakephp/cakephp/issues/7573
