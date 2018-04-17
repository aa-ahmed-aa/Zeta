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
bool sum(vector<int> &arr,int size1)
{
    long long  s=0,l=0,r=0;
    while(l<size1)
    {
        while(r<size1)
        {
            s+=arr[r];
            if(s==0)
                return true;
            r++;
        }
        s=0;
        l++;
        r=l;
    }
    return false;
}
int main()
{
   Allah_Fowk_kyd_Elmo3tden();
    //file();
    //Good chairty
    /*int n;cin>>n;
    vector<int>v(n);
    for(int i=0;i<n;i++)
    {
        cin>>v[i];
    }
    int c=0;
    for(int i=0;i<n;i++)
    {
        for(int j=i+1;j<n;j++)
        {
            if((v[i]+v[j])%4==0)
                c++;
        }
    }
    cout<<c;
    */
    //first 1;

    /*int n;
    cin>>n;
    vector<int>arr(n);
    for(int i=0;i<n;i++)
        cin>>arr[i];
    bool t=sum(arr,n);
    if(t==true)
        cout<<"Happy";
    else
        cout<<"Depressed";*/
    /*
    string s;cin>>s;
    long long int sum=0;
    for(int i=0;i<s.size();i++)
        sum+=s[i];
    if(isprime(sum))
        cout<<"Yes";
    else
        cout<<"No";*/
// hurry!
    ifstream input("Harry.in");
    ofstream output;
    output.open("Harry.out");

    int n;input>>n;
    vector<int>v(n),v1;
    for(int i=0;i<n;i++)
        input>>v[i];
    int k;input>>k;
    sort(v.begin(),v.end());
    long long int sum=0;
    for(int i=k;i<n;i++)
        sum+=v[i];
    output<<sum;

    return 0;
}
