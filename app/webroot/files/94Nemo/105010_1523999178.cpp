#include <iostream>
#include<vector>
#include<algorithm>
#include<fstream>
using namespace std;
void Allah_Fowk_kyd_Elmo3tden()
{
    ios::sync_with_stdio(0);
    cin.tie(0);
    cout.tie(0);
}
bool isprime(int n)
{
    if(n==2)
        return true;
    if(n<2||n%2==0)
        return false;
    for(int i=3;i*i<=n;i+2)
    {
        if(n%i==0)
            return false;
    }
    return true;
}
void file()
{
    freopen("Prime.in","a",stdin);
    freopen("Prime.out","b",stdout);
}
int main()
{
   Allah_Fowk_kyd_Elmo3tden();
    file();
    string s;cin>>s;
    long long int sum=0;
    for(int i=0;i<s.size();i++)
        sum+=s[i];
    if(isprime(sum))
        cout<<"Yes";
    else
        cout<<"No";

   /* int n;cin>>n;
    vector<int>v(n),v1;
    for(int i=0;i<n;i++)
        cin>>v[i];
    int k;cin>>k;
    sort(v.begin(),v.end());
    long long int sum=0;
    for(int i=k;i<n;i++)
        sum+=v[i];
    cout<<sum;*/
    return 0;
}
