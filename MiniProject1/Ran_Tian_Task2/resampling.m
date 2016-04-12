
% this function is to resample the particles for given pmfs
function res = resampling(particles,probability)

[row,col] = size(particles);
res = zeros(row,col);
% pro = zeros(1,col);

for i=1:col
   prob = rand();%generate a parameter from the uniform distribution first
   %then judge this parameter to fall into which range from the CDF 
   left_bound=0;
   for j=1:col
       if(probability(j) + left_bound < prob)
          left_bound =  probability(j) + left_bound;
       else 
           break;
       end      
   end
   res(:,i)=particles(:,j);
%    pro = probability(j);
end

