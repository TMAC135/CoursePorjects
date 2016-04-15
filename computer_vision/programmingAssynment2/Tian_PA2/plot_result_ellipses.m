
% this is the function is to plot the results ellipse we have checked
function plot_result_ellipses(result,length,width)

image =zeros(length,width);

num_ellipses = size(result,1);

figure();
imshow(image);
hold on;

%(x-x0)^2/a^2 + (y-y0)^2/b^2 =1
% set the bound firstly
x_min = 20;
x_max = 400;
% y_min = 80;
% y_max = 400
for i=1:num_ellipses
    a=result(i,1);
    b=result(i,2);
    x0=result(i,3);
    y0=result(i,4);
%     for x=x_min:x_max
%        if(1-((x-x0)/a)^2 >= 0)
%            T = b*sqrt(1-((x-x0)/a)^2);%temp variable
%            y1 = round(T + y0);
%            y2 = round(-T +y0);
% 
%            image(x,y1)=1;
%            image(x,y2)=1;
%        
%        end
%     end

    for theta=-pi:0.01:pi
       x=x0+a*cos(theta);
       y=y0+b*sin(theta);
       x=round(x);
       y=round(y);
       image(x,y)=1;
    end
    
    imshow(image);
end

title('Ellipses I Detect from the Original Image');
hold off;
