
%%
% the functionality of this function is the same as find() in Matlab
%input: binary matrix
%output: matrix with size(n,2),the entry of each row is the indecies of the
%       element which is 1 in binary matrix

function [rows,cols] = findEdge(binary_image)

res = [];
index=1;

for i=1:size(binary_image,1)
   
    for j=1:size(binary_image,2)
       if(binary_image(i,j) == 1)
          res(index,:) = [i,j];
          index = index +1;
       end
    end
end

rows = res(:,1);
cols = res(:,2);
