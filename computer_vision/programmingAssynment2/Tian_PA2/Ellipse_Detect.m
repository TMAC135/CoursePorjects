%% Section0 :initilization 
close all;
clear all;
% get the binary image after edge detection
binary_image = sobel_edge('ellipse1.jpg');

[length,width] = size(binary_image);
binary_image = binary_image(3:length-2,3:width-2);%eliminate the one's I create in PA 1
[length,width] = size(binary_image);
% imshow(binary_image);

%find the indices of the row and col for element 1
%[rows,cols] = find(binary_image);%build in find function
[rows,cols] = findEdge(binary_image); %self-written function
total_count = size(rows);

%set the maximum and minimum bound and step size values for x0,y0,a,b
x0_max = 300;
x0_min = 20;
y0_max = 400;
y0_min = 120;


a_max = 90;
a_min= 20;
b_max = 180;
b_min = 60;


x0_steps = 50;
y0_steps = 50;
a_steps = 70;
b_steps = 70;

x0_step = (x0_max - x0_min)/x0_steps;
y0_step = (y0_max - y0_min)/y0_steps;
a_step = (a_max - a_min)/a_steps;
b_step = (b_max - b_min)/b_steps;

%% Section1 :Generate hough Matrix.

%initiliza the hough space, where hough_space(i,j)represent the number of
%points pssing through the ellipse with parameter(i,j)
hough_space = zeros(a_steps+1,b_steps+1,x0_steps+1,y0_steps+1);

%transform the original points to hough space:
% x0 = x - a*cos(theta)
% y0 = y - b*sin(theta)
% for ii=1:total_count
%     tmp = [rows(ii),cols(ii)];%get the current edge point
% %     theta=0;
%     for jj = 1:steps
%        theta = (jj-1)*(2*pi)/steps;      
%        for aa=1:steps
%           x0 = tmp(1) - (a_min + (aa-1)*a_step)*cos(theta);
%           x0 = round((x0 - x0_min)/x0_step);
%           if(x0 > x0_min && x0 <= x0_max)
%               for bb=1:steps
%                   y0 = tmp(2) - (b_min + (bb-1)*b_step)*sin(theta);
%                   y0 = round((y0-y0_min)/y0_step);
%                   if(y0 > y0_min && y0 <= y0_max)
%                       hough_space(x0,y0,aa,bb) = hough_space(x0,y0,aa,bb)+1;
%                   end
%               end
%           end
%        end
%     end
%         
% end

% use the normal representation for the ellipse
% (x-x0)^2/a^2 + (y-y0)^2/b^2 =1
for ii=1:total_count
   tmp = [rows(ii),cols(ii)];
   for aa=1:a_steps+1
       a = a_min + (aa-1)*a_step;
       for bb=1:b_steps+1
           b = b_min + (bb-1)*b_step;
           for xx = 1:x0_steps+1
              x = x0_min + (xx-1)*x0_step;            
              %there are two representations for y0 for given x0,a,b,x,y
              if((1-((tmp(1)-x)/a)^2) > 0)           
                  T = b*sqrt(1-((tmp(1)-x)/a)^2);%temp variable
                  y1=T + tmp(2);
                  y2=-T + tmp(2);

                  yy1 = round((y1-y0_min)/y0_step)+1;
                  if(yy1 >=1 && yy1 <= y0_steps+1)                  
                     hough_space(aa,bb,xx,yy1) = hough_space(aa,bb,xx,yy1)+1; 
                  end


                  yy2 = round((y2-y0_min)/y0_step)+1;
                  if(yy2 >=1 && yy2 <= y0_steps+1)

                     hough_space(aa,bb,xx,yy2) = hough_space(aa,bb,xx,yy2)+1; 
                  end
            
              end
           end
       end
   end
end

%store the hough_space matrix, since it will take a while(abount 5~10 minutes
% based on your computer) to get this
%matrix
save('my_running_hough_matrix.mat','hough_space');

%% Section 2: set the threshold value to determine whether it is valid
load('my_running_hough_matrix.mat');%load the matrix to debug
max_count = max(max(max(max(hough_space))));

proportion = 0.6;%set the proportion value manually
thresh_value = max_count * proportion;%I will regard the index of 
                                        %count > threshold as a line
result = [];%store the parameter of final result
cur_index=1;

for xx=1:x0_steps
   for yy=1:y0_steps
      for aa=1:a_steps
         for bb=1:b_steps
            if(hough_space(aa,bb,xx,yy) >= thresh_value)
                a = a_min + (aa-1)*a_step;
                b = b_min + (bb-1)*b_step;
                x = x0_min + (xx-1)*x0_step;
                y = y0_min + (yy-1)*y0_step;
                result(cur_index,:) = [a,b,x,y];
                cur_index = cur_index+1;
            end
         end
      end
   end
end


% result
%again, there are multiple parameters for a single ellipse, I take the average
%of these parameters.
cur_entry = result(1,:);
sum=zeros(4,1);
count=0;
result_new=[];
cur_index=1;
% here i set the threshold value for x0 to determine the distinct ellipse  
for i=1:size(result,1)
    if(result(i,3) - cur_entry(3) <= 20)
       sum = [sum(1)+result(i,1),sum(2)+result(i,2),sum(3)+result(i,3),...
                sum(4)+result(i,4)];
            count = count +1;
    else
       result_new(cur_index,:)=[sum(1)/count - 5,sum(2)/count - 5,sum(3)/count,...
                                sum(4)/count];
       sum=result(i,:);
       count = 1;
       cur_entry = result(i,:);
       cur_index = cur_index+1; 
        
    end
end

% 
figure(),imshow(binary_image);
plot_result_ellipses(result_new,length,width);
result_new %show the final result in the command window


