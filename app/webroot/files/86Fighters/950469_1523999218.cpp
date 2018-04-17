#include<iostream>
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
	file();

	int n,m,arr[100],sum=0;
	 cin>>n;
	 for(int i=0;i<n;i++)
	 {
		 cin>>arr[i];
	 }
	 cin>>m;
	 sort(arr,arr+n);
	 for(int i=m;i<n;i++)
	 {sum+=arr[i];
	 }
	 cout<<sum;



	return 0;
}