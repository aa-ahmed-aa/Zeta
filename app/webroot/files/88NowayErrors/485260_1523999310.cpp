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
/*
ifstream in("");
ofstream out;
out.open("");
*/
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
    ifstream in("Prime.in");
    ofstream out;
    out.open("Prime.out");
    string s;
    in>>s;
    int sum=0;
    for(int i=0;i<s.length();i++)
    {
        sum+=s[i];
    }
    if(isprime(sum))
        out<<"Yes"<<endl;
    else
        out<<"No"<<endl;
}

