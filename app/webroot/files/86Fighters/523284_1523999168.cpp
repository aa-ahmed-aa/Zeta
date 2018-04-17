#include<iostream>
#include<algorithm>
#include <math.h>
#include<string>
using namespace std;
void file()
{
	freopen("Happy.in","r",stdin);
	freopen("Happy.out","r",stdout);

}
int main()
{
	file();
	long long n,sum=0;
	int c=0,arr[1000];
	cin>>n;
	for (int i=0;i<n;i++)
	{cin>>arr[i];}
	if (count(arr,arr+n,0)>=1)
		cout<<"Happy";
	else
	{

		for(int i=0;i<n;i++)
		{
			for(int j=i;j<n;j++)

			{sum+=arr[j];
			if (sum==0)
			{c++;
			break;
			}}
			sum=0;
			if (c==1)
			{break;}
		}
		if (c==1)
			cout<<"Happy";
		else cout<<"Depressed";
	}


	return 0;
}