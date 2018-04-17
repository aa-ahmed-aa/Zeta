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
int n,x,arr[100000],sum=0;
cin>>n;
for(int i=0;i<n;i++)
{
    cin>>arr[i];
}
cin>>x;
sort(arr,arr+n);
for(int i=0;i<=x;i++)
{
    sum+=arr[i+x];
}
cout<<sum<<endl;
    return 0;
}
