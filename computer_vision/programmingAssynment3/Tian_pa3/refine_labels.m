%% Refine and eliminate some labeled regions
% Input: union_set: the union set of the connected region before refine
%        labels: the labels of connnected regions before refine
%        threshold: the threshold value we choose to eliminate some
%                   regions,based on my trials, the thresholding value 150
%                   is a good choice
% Output: labels_after_refine: the labels of connnected regions after refine


function labels_after_refine = refine_labels(union_set,labels,threshold)



keys = union_set.keys;
remove_labels = []; 

for i=1:length(keys)
    tmp =  union_set(char(keys(i)));
    %set a threshold value when the number of labels is less than 150
    if(length(tmp) < threshold)
        
       for j=1:2:length(tmp)
           labels(tmp(j),tmp(j+1)) = 0;
       end
       remove_labels = [remove_labels keys(i)];
%        remove(union_set,keys(i));
    end   
end
%remove labels
for i=1:length(remove_labels)
   remove(union_set,remove_labels(i)); 
end

labels_after_refine = labels;