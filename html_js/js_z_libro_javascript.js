function curry (fn, scope)
{
    var scope = scope || window;
    var args = [];
    for (var i=2, len = arguments.length; i < len; ++i)
    {
        args.push(arguments[i]);
    }
    
    return function()
    {
        var args2 = [];
        for (var i = 0; i < arguments.length; i++)
        {
            args2.push(arguments[i]);
        }
        var argstotal = args.concat(args2);
        alert(argstotal);
        return fn.apply(scope, argstotal);
    };
}

//var test=function(){alert("hola mundo");};
var fToCurry=function(p1,p2,p3)
{
    return p1*p2*p3;
};

var oCurry = curry(fToCurry,null, 7);
//alert(oCurry(2,3,4));
//alert(oCurry(1,1,2));

//fibonaci 1+2+3+4+ ... n
//1+2+3+4+(n) + (n+1) + (n+2) + ...
//1 + (1+1) + (1+2) + (1+3) ... 1 + (1+1) + (1+n) =
//3n+3 = 3(n+1) .. mn+m = m(n+1) 1+2+3+4+5 = 15

// 2 = 1 + 2 =3
// 3 = 1 + 2 + 3 = 6
// 4 = 1 + 2 + 3 + 4 = 10
// n = 1 +  + n
//n = 1 + ..+(n-1) + (n)
//n = n + (n-1) + ...+1
//(2n) = (1+n)+(2+(n-1))..+(n+1)
//2n = n(n+1)
//n = n(n+1) / 2
//n = (n^2 + n) / 2

function fibonacci(n)
{
    //caso tribial 1
    if (n==1)
    {
        return 1;
    }
    else
    {
        return n + fibonacci(n-1);
    }
}

//3! = 3 * 2 * 1

function factorial(n)
{
    if(n==0)
    {
        return 1;
    }
    else
    {
        return n * factorial(n-1);
    }
}



alert(fibonacci(5));
alert(factorial(5));
alert(factorial(19).fn);
