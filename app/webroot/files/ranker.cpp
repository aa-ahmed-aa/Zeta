# include <iostream>
# include <cmath>
# include <stdio.h>
# include <ctime>
# include <vector>
# include <sstream>
# include <utility>
# include <bits/stdc++.h>
# include <sstream>

using namespace std;

vector<double> explode(string const & s, char delim)
{
    vector<double> result;
    istringstream iss(s);

    for (string token; getline(iss, token, delim); )
    {
        result.push_back(atof(token.c_str()));
    }

    return result;
}

int main()
{
        time_t now;
        string helper;
        vector<double> helpervector;
        struct tm start_time,end_time;
        double hour,minute,seconds;
        double results,solving_time;
        double t,rank,totalRank=0;

        //the start-time is constant
        start_time = *localtime(&now);
        start_time.tm_hour = 13; start_time.tm_min = 20; start_time.tm_sec = 00;
        start_time.tm_mon = 0;  start_time.tm_mday = 0;

        while(t)
        {
            //take the rank and the end-time
            cout<<"please enter the rank of this problem : "<<endl;
            cin>>rank;
            cout<<"please enter time : "<<endl;
            cin>>helper;
            helpervector = explode(helper,':');
            hour = helpervector[0];
            minute = helpervector[1];
            seconds = helpervector[2];


            //the input
            end_time = *localtime(&now);
            end_time.tm_hour=hour; end_time.tm_min=minute; end_time.tm_sec = seconds;
            end_time.tm_mon = 0;  end_time.tm_mday = 0;

            results = difftime(mktime(&end_time),mktime(&start_time));

            //this problem solving time
            solving_time = results/60;
            cout<<"Solving Time = "<<solving_time;
            totalRank += (rank-solving_time);
            cout<<"Do you have another problem (1 for yes || 0 for no ): ";
            cin>>t;
        }

        cout<<"Total Rank :"<<(int)totalRank<<endl;
  return 0;
}
