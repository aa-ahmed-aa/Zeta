#include <iostream>
#include <cstring>
#include <map>
#include<conio.h>
#include <deque>
#include <queue>
#include <stack>
#include <sstream>
#include <numeric>
#include <iostream>
#include <iomanip>
#include <cstdio>
#include <cmath>
#include <fstream>
#include <string>
#include <cstdlib>
#include <ctime>
#include <functional>
#include <algorithm>
#include <vector>
#include <set>
#include <unordered_set>
#include <complex>
#include <list>
#include <climits>
#include <cctype>
#include <bitset>
#include<unordered_map>
using namespace std;
bool subArrayExists(int arr[], int n)
{
    unordered_map<int,bool> sumMap;
 
    // Traverse throught array and store prefix sums
    int sum = 0;
    for (int i = 0 ; i < n ; i++)
    {
        sum += arr[i];
 
        // If prefix sum is 0 or it is already present
        if (sum == 0 || sumMap[sum] == true)
            return true;
 
        sumMap[sum] = true;
    }
    return false;
}
 
// Driver code
int main()
{
	ifstream input("Happy.in");
	ofstream output;
	output.open("Happy.out");
	int n;
	input>>n;
	int * arr = new int[n];
	for(int  i = 0; i < n ; i ++)
		input>>arr[i];
    if (subArrayExists(arr, n))
        output << "Happy";
    else
        output << "Depressed";
	output.close();
    return 0;
}