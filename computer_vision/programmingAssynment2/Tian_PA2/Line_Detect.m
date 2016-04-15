%% Here is the script to detect the lines in the image

% get the binary image after edge detection
binary_image = sobel_edge('line1.jpg');

[length,width] = size(binary_image);
binary_image = binary_image(3:length-2,3:width-2);%eliminate the one's I create in PA 1
[length,width] = size(binary_image);
% imshow(binary_image);

%find the indices of the row and col for element 1
%[rows,cols] = find(binary_image);%build in find function
[rows,cols] = findEdge(binary_image); %self-written function
total_count = size(rows);

%set the step size values for rou and theta
rou_max = round(sqrt(length^2 + width^2));
rou_min = 0;
rou_steps = 2000;
theta_max = pi;
theta_min = 0;
theta_steps = 1000;

rou_step = (rou_max - rou_min)/rou_steps;
theta_step = (theta_max - theta_min)/theta_steps;

%initiliza the hough space, where hough_space(i,j)represent the number of
%points pssing through the line with parameter(i,j)
hough_space = zeros(theta_steps+1,rou_steps+1);


%transform the original points to hough space:rou = x*cos(theta) + y*sin(theta)
for ii=1:total_count
    tmp = [rows(ii),cols(ii)];%get the current edge point
    for jj=0:theta_steps
        rou_cal = round(...
                        tmp(1)*cos(theta_min + jj*theta_step)... 
                        + tmp(2)*sin(theta_min +jj*theta_step));
        
        if(rou_cal >= rou_min && rou_cal <= rou_max)
            hough_space(jj+1,round((rou_cal-rou_min)/rou_step)+1)... 
            = hough_space(jj+1,round((rou_cal-rou_min)/rou_step)+1) +1;
        end
    end
    
end

%set the threshold value to determine whether it is valid
max_count = max(max(hough_space));

proportion = 0.6;%set the proportion value manually
thresh_value = max_count * proportion;%I will regard the index of 
                                        %count > threshold as a line
result = [];%store the parameter of final result
cur_index=1;

for kk = 1:theta_steps
   
    for mm=1:rou_steps
       if(hough_space(kk,mm) >= thresh_value)
          k = theta_min + theta_step*kk;
%           k=(theta_min + theta_step*kk)*(180/pi);%output the degree representation
          m = rou_min + rou_step*mm;
          result(cur_index,:) = [k,m];
          cur_index = cur_index + 1;%ready for the next loop
       end
    end
    
end

%here there are multiple parameters for a single line, I take the average
%of these parameters
cur_entry = result(1,:);
sum =zeros(2,1);
count=0;

result_new = [];
cur_index=1;
for i=1:size(result,1)
    %here i set the threshold value for theta and rou are 3(in degree) and
    %15(in pixels)
   if(abs(result(i,1) - cur_entry(1)) <= 3 && abs(result(i,2) - cur_entry(2))<=15)
      sum = [sum(1)+result(i,1),sum(2)+result(i,2)];
      count = count +1; 
   else
       result_new(cur_index,:)=[sum(1)/count,sum(2)/count];
       sum=result(i,:);
       count = 1;
       cur_entry = result(i,:);
       cur_index = cur_index+1;       
   end
end
%calculate the last element
result_new(size(result_new,1),:) = [(result_new(size(result_new,1),1)+sum(1))/(count+1),...
                                    (result_new(size(result_new,1),2)+sum(2))/(count+1)];

figure(),imshow(binary_image),title('original image');

plot_result_lines(result_new,length,width);
result_new %show the final result in the command window


