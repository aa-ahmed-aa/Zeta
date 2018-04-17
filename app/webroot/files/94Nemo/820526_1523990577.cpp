#include <bits/stdc++.h>

using namespace std;
void Allah_Fowk_kyd_Elmo3tden()
{
    ios::sync_with_stdio(0);
    cin.tie(0);
    cout.tie(0);
}
void file()
{
    freopen("Harry.in","a",stdin);
    freopen("Harry.out","a",stdout);
}
int main()
{
   Allah_Fowk_kyd_Elmo3tden();
    file();
    int n;cin>>n;
    vector<int>v(n),v1;
    for(int i=0;i<n;i++)
        cin>>v[i];
    int k;cin>>k;
    sort(v.begin(),v.end());
    long long int sum=0;
    for(int i=k;i<n;i++)
        sum+=v[i];
    cout<<sum<<endl;
    return 0;
}
