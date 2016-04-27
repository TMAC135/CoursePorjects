%% This function is used to plot different regions in different colors
% input: union_set
% Notice:here I only assign 7 colors for 7 regions since I know 
%        there are 7 regions before hand.
function plot_regions(union_set,image)

keys= union_set.keys;

%label 1 : red ==>(255,0,0)
tmp = union_set(char(keys(1)));
for i = 1:2:length(tmp)
    image(tmp(i),tmp(i+1),2)=0;
    image(tmp(i),tmp(i+1),3)=0;
end

%label 2 : lime ==>(0,255,0)
tmp = union_set(char(keys(2)));
for i = 1:2:length(tmp)
    image(tmp(i),tmp(i+1),1)=0;
    image(tmp(i),tmp(i+1),3)=0;
end

%label 3 : blue ==>(0,0,255)
tmp = union_set(char(keys(3)));
for i = 1:2:length(tmp)
    image(tmp(i),tmp(i+1),1)=0;
    image(tmp(i),tmp(i+1),2)=0;
end

%label 4 : yellow ==>(255,255,0)
tmp = union_set(char(keys(4)));
for i = 1:2:length(tmp)
    image(tmp(i),tmp(i+1),3)=0;
end

%label 5 : cyan ==>(0,255,255)
tmp = union_set(char(keys(5)));
for i = 1:2:length(tmp)
    image(tmp(i),tmp(i+1),1)=0;
end

%label 6 : Magenta ==>(255,0,255)
tmp = union_set(char(keys(6)));
for i = 1:2:length(tmp)
    image(tmp(i),tmp(i+1),2)=0;
end

%label 7: gray ==>(128,128,128)
tmp = union_set(char(keys(7)));
for i = 1:2:length(tmp)
    image(tmp(i),tmp(i+1),1)=0;
    image(tmp(i),tmp(i+1),2)=0;
    image(tmp(i),tmp(i+1),3)=0;
end

imshow(image);

