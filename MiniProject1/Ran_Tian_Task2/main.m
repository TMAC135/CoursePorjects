
%% pseudo code 
clear all;
close all;
clc;
% Read the image to matrix - I
num_image = 350;
I_total = zeros(288,352,3,num_image);
cd('img');
for i = 1:num_image
    if (i < 10)
        filename = ['000',num2str(i),'.jpg'];
    elseif (i < 100)
        filename = ['00',num2str(i),'.jpg'];
    else
        filename = ['0',num2str(i),'.jpg'];
    end
    I_total(:,:,:,i) = imread(filename);
end
cd ..;

% the particle number
num_part = 1000;


%initilization for the paricles
particles = zeros(4,num_part);
particles(1:2,:) = 200*ones(2,num_part);%suppose the initial position is 200,200

%initilization for the video
Video = VideoWriter('Ran_Tian Woman Track video.avi');
open(Video);
    
%initilization for likelihood,prior and posterior 
likelihood = zeros(1,num_part);

for i=1:num_image
    
    %1:correction step
    I_after = pinklikelihood(I_total(:,:,:,i));
    
    part_pos = particles(1:2,:);% propagate the position probability
    for j=1:num_part
       pos = part_pos(:,j);
       likelihood(j) = I_after(pos(1),pos(2));
    end
    
    %normalize the probability
    total = sum(likelihood);
    for ii=1:num_part
         likelihood(ii) =likelihood(ii)/total;
    end
    
    %2:prediction step
    
    %update the particles based on the linear model
    for j=1:num_part
       particles(:,j) = linear_model(particles(:,j));      
    end

    %resampling,update the particles based on the posterior probability
    particles(1:2,:)  = resampling(particles(1:2,:),likelihood);    

    %plot the estiation for the current iteration
    plotstep(particles, I_total(:,:,:,i), likelihood,i, 20);
    fig = figure(1);
    f = getframe(fig);
    writeVideo(Video,f);
end

close(Video);