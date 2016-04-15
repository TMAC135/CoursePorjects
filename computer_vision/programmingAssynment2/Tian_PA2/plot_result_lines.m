

function plot_result_lines(result,length,width)

image =zeros(length,width);

num_lines = size(result,1);

figure();
imshow(image);
hold on;
for i=1:num_lines
    theta = result(i,1);
    rou = result(i,2);
    %calculate x,y
    for ii=1:length
        y = round((rou -ii*cos(theta))/sin(theta));
        if( y>0 && y<=width)
           image(ii,y)=1; 
        end
    end
    imshow(image);
end

title('Lines I Detect from the Original Image');
hold off;



