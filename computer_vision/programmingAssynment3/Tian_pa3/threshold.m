%% This is the function to threshold the grey image 
% Input: the grey scale image - img
%        the histogram of the image - histogram
% Output: the binary image, 1's represent the background and the
% original pixel value is greater than threshold value(T0), 0's represent 
% the object and the original pixel value is less than 
% threshold value(T0).

function [BW T_new] = threshold(img,histogram)
[row,col] = size(img);

% initialization
BW = ones(row,col);

% find the threshold value
T_old = 0; %initial threshold value
T_new = 120;

while abs(T_new-T_old) > 10 
    T_old = T_new;
%     tmp0 = sum(histogram(1:T_old));
%     tmp1 = sum(histogram(T_old+1:256));
    mean0 = find_statistic(histogram(1:T_old));
    mean1 = T_old+find_statistic(histogram(T_old+1:256));
    T_new = floor((mean0+mean1)/2);
%     T_new = mean0 + find_statistic(histogram(mean0:mean1));

end
% T_new %show the threshold value in the concole
% set the binary image
for i=1:row
   for j=1:row
      if(img(i,j) <= T_new)
          BW(i,j)=0;          
      end
   end
end