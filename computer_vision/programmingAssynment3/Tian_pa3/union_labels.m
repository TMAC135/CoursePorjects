%% Union the two set in the dictionary
%Functionality: Union the two key-valus pairs into one key-value pair, num1 and num2
% are two lables in the dictionary, choose the min value of num1 and num2
% and merge those two values into one.
% Input: dict: the dictionary contains all sets
%        num1,num2: two labels corresponding to the keys in dict
% 

function res = union_labels(dict,num1,num2,labels)

label1 = num2str(num1);
label2 = num2str(num2);


% disp(strcat('combine',num2str(num1),'and',num2str(num2)))
if(num1 < num2) %merge num2 to num1
   tmp = dict(label2);
   dict(label1) = [dict(label1) tmp];
  
   %remove the larger label and change the origial label   
   for i=1:2:length(tmp)
      labels(tmp(i),tmp(i+1)) = num1; 
%       tmp(i)
%       tmp(i+1)
   end
   remove(dict,label2);
%    disp(strcat('remove label',num2str(label2)))
%    dict(num2str(label2))
   
else %merge num1 to num2
    tmp = dict(label1);
    dict(label2) = [dict(label2) tmp];
    %remove the larger label and change the origial label   
    for i=1:2:length(tmp)
      labels(tmp(i),tmp(i+1)) = num2; 
%       tmp(i)
%       tmp(i+1)
    end
    remove(dict,label1);
%     disp(strcat('remove label',num2str(label1)))
%     dict(num2str(label2))
end

res = labels;

%test code
% shiyan = containers.Map;
% shiyan('1') = [1 1 1 2 1 3];
% shiyan('2') = [2 1 2 2 2 3];
% labels = [1 1 1;2 2 2];
% union_labels(shiyan,1,2,labels);