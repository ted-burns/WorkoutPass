#Overall idea
  The main point of this program is to create an intelligent and dynamic workout tracker.
  Ideally, it will be able to create workouts for me based on muscle groups targeting and
  muscle confusion.

##Structure

###index.php
  has options for:
    Asking to generate a new workout
    Viewing account

###workout.php
  Data is populated from a mySQL database
  Server calculates next workout type based on a plan's rotation

###user.php
  User preferences page

##Workout picking algorithm

###overview
  Basically, it has to be able to do strength training, and endurance
    With strength training:
      3 subcategories
        HIIT
          roughly 15 seconds break, with between 15 and 60 seconds per set, with a 2 minute or so break after each round
        Moderate-break
          roughly 45 seconds break, typically 3x10?
        Long-break
          roughly 1:30 break, typically 5x5 or 4x8
    Endurance training:
      More flexible
      Most of the recommendations with this are within the server-side, not the sql
  Actual algorithm:
    Checks for the current plan (cutting, bulking)
    If cutting, generate a HIIT workout:
      Default duration to be 75 min (subject to change),
      Check and see if there are any muscle groups that have been worked less than the others for HIIT training, if so:
        use that muscle group (set muscle group for this workout to one of the underused ones)
      if not:
        randomly select a muscle group
      Pick 4 or 5 exercises (subject to change), picking a main muscle for the sets


    If bulking, generate a strength workout:
