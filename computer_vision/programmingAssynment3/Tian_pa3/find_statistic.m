
%% this function is to find the mean of the histogram array
function res = find_statistic(histogram)

% this is based on the mean of histogram
[row,col] = size(histogram);
total = sum(histogram);
cur = 0;
for i=1:col
    cur = cur + histogram(i)*(i-1);
end
res = floor(cur/total);


% this is based on the median of histogram
% half = ceil(sum(histogram)/2);
% i=1;
% while half > 0
%     half = half - histogram(i);
%     i = i +1;
% end
% res = i;

% this is based on the common value of the histogram
% [value,res] = max(histogram);
