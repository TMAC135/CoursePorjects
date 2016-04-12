
% this function is to update the state, we assume the linear model,
%A = [eye(2) delta*eye(2);zeros(2) eye(2)];
%B = [sigma1*eye(2) zeros(2);zeros(2) sigma2*eye(2)];
% where sigma1 and simga2 are the parameters we can tune
% res = A*input + B*u;
function res=linear_model(input)

sigma1 = 0.001;
sigma2 = 1;
delta =2;

A = [eye(2) delta*eye(2);zeros(2) eye(2)];
B = [sigma1*eye(2) zeros(2);zeros(2) sigma2*eye(2)];

res = round(A*input+B*randn(4,1));
res(1) = round(res(1))+1;
res(2) = round(res(2))+1;

% we need to judge if the state(position) is out of the bound, if yes, I
% just set it to the bound value
if(res(1)<=0)
    res(1) =1;
else if(res(1)>480)
    res(1) = 480;
    end
end

if(res(2)<=0)
    res(2) =1;
else if(res(2)>640)
    res(2) = 640;
    end
end