#include<fstream>
#include <iostream>
#include<math.h>
#include<string>
#include<vector>
#include<algorithm>
#include<iomanip>
#include<cstring>
#include<string.h>
using namespace std;
int main()
{
ifstream input("prime.in");
ofstream output;
output.open("prime.out");

int a=0;
long long sum=0;
string x;
getline(input,x);
for(int i=0;i<x.size();i++)
{
    sum+=  x[i];
}
for(int i=2;i<=sum;i++)
{
    if(sum%i==0)
        a++;
}
    if(a==1)
        output<<"Yes"<<endl;
    else
        output<<"No"<<endl;
   output.close();
    return 0;
}
