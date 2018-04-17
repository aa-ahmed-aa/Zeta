#include<iostream>
#include<fstream>
#include<algorithm>
#include <math.h>
#include<string>
using namespace std;
void file()
{
	freopen("Prime.in","r",stdin);
	freopen("Prime.out","r",stdout);

}
int main()
{
	ifstream input ("Prime.in");
	ofstream output ;
	output.open ("Prime.out");
	long long int c=0,sum=0;
	string s;
	input>>s;
	for(int i=0;i<s.size();i++)
	{
		sum+=s[i];
	}
	for(int g=2;g<=pow(sum,0.5);g++)
	{
		if(sum%g==0)
		{c++;
		break;
		}
	}
	if(c==0)
		output<<"Yes";
	else
		output<<"No";



	return 0;
}
