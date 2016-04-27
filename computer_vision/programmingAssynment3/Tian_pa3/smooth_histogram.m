
%% this function is to count the histogram of the image and 
% smooth the histogram with its two neighbors
% 
% Input: the grey scale image
% Output: the 1D array with size(1*256), the value of each index is the 
%frequecy of pixcel intensity.
% 
function res = smooth_histogram(img)

[row,col] = size(img);
% initilization
res = zeros(1,256); %0~255

% fill the array first
for i=1:row
   for j=1:col
      res(img(i,j)+1) =  res(img(i,j)+1) +1;
   end
end

% take the average of the 2 neighbors for the histogram array
for i =2:255
    res(i) = floor((res(i-1) + res(i) + res(i+1))/3);
end

