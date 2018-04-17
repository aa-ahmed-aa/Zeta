#include <bits/stdc++.h>

using namespace std;

typedef long long ll;
typedef unsigned long long ull;

#define all(v) v.begin(),v.end()

bool isprime(ll n)
{
    if(n<2)
        return false;
    if(n==0)return true;
    if(n%2==0)
        return false;
    for(ll i=3;i*i<=n;i+=2)
    {
        if(n%2==0)
            return false;
    }
    return true;
}
ll gcd(ll x,ll y)
{
    for(ll i=min(x,y);i>=1;i--)
    {
        if(x%i==0&&y%i==0)
            return i;
    }
}
void file()
{
    freopen("Happy.in","r",stdin);
    freopen("Happy.out","r",stdout);
}
bool perm(vector<int> v,int n)
{

    for(int j=0;j<v.size()-n;j++)
    {
        int sum=0;
        for(int i=j;i<n+j;i++)
        {
            sum+=v[i];
            if(sum==0)
                return true;
        }
    }

    return false;
}
int main()
{

    file();
    int n;
    cin>>n;
    vector<int> v(n);
    bool happy=false;
    for(int i=0;i<n;i++)
    {
        cin>>v[i];
        if(v[i]==0)
            happy=true;
    }
    if(happy)
    {
        cout<<"Happy";
        return 0;
    }
    else
    {
        for(int i=2;i<=n;i++)
            if(perm(v,i))
        {
            cout<<"Happy";
            return 0;
        }
    }
    cout<<"Depressed";
    return 0;
}
