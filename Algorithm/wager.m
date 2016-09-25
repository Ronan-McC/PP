clear all; 
close all; 
clc;

% VARIABLES TO BE RECEIVED FROM BETFAIR 

BFW = 10; %Bet Fair Win price (lay price, note; could use half-way between back & lay for aggresive) for horse (note: decimal price) e.g. 10 = 9/1
BFplace = 2.5; %Bet fair place price (decimal lay price) e.g. 2 = evens, 1/1
horse_total = 10; %no. of horses available (starters) for betting on BF e.g 10 horses



% VARIABLES TO RECEIVED FROM ODDSCHECKER (BEST ODDS FOR GIVEN HORSE)

b = 8; %Bookies win price for horse (note: fractional odds!!) e.g. 8 = 8/1
horse_total2 = 10; %no. of horses available (starters) for betting on BF e.g 10 horses

if horse_total ~= horse_total2
    race_fraction = 0;
else
    if horse_total < 5
        race_fraction = 0;
    elseif horse_total < 8 
        race_fraction = 4;
    elseif horse_total < 12
        race_fraction = 5;
    else race_fraction = 4; % covers all handicap races - note: this method does not cover handicap races with less than 12 runners or non-handicaps with >11
    end
end

if (race_fraction ~= 0) 
    beach = b / race_fraction; % beach = best offered e/w price
else beach = 0;
end

p = 1/BFW; % probability of horse winning;
q = 1 - p; % probability of horse losing;

pplace = 1 /BFplace; % probability of horse placing;
qplace = 1 - pplace; % probability og horse not placing;

wager = ((b*p) - q) / b

wagerEW = (wager) + (((beach*pplace) - qplace) / beach)

if wagerEW > wager
    wagerEW
else wager
end
    
      

