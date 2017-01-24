

var scene_data = [

  {

    name: "idle",
    text: "You are not doing anything.",
    pretext: "The World is your oyster. You are in a position to take the opportunities that life has to offer.",


    parts: {

      name: "one",
      text: "you advance the scene",


    },

    actions: [
      {
        label: "Move",
        trigger: "scene:move"
      }, {
        label: "Eat",
        trigger: "scene:eat"
      }, 
      {
        label: "Fap",
        trigger: "scene:fap"
      }, 
       {
        label: "Sleep",
        trigger: "scene:rest"
      }, {
        label: "Forage",
        trigger: "scene:forage"
      }, {
        label: "Look around",
        trigger: "scene:inspect"
      }


    ]




//inspect
}, {
    name: "inspect",
    text: "You look around at your surroundings a little more closely.",
    pretext: "How many sleepies",
    require: "player.sleep < 60",


    parts: [
      { 
      name: "nap",
      text: "You find {@test} somewhere reletively comfy looking and curl up. It's not very restful but it helps clear your head.",
      }, { 
        name: "sleep",
        text: "You search around until you find a suitable place where you're least likely to be disturbed; making yourself as comfortable as possible before eventually drifting off. You awake some hours later, refreshed!"
      }
    ],


    actions: [
      {
        label: "Just a nap.",
        trigger: "part:nap"

      }, {
        label: "As long as I need!",
        trigger: "part:sleep"
      }, {
        label: "Nevermind",
        trigger: "cancel"
      }
    ]



//new
}, {
    name: "new-game",
    text: "You start playing a silly game.",
    

    // test
  }, {
    name: "test",
    text: "testing",
    pretext: "How many sleepies",
    require: "player.sleep < 60",


    parts: [
      { 
      name: "nap",
      text: "You find {@test} somewhere reletively comfy looking and curl up. It's not very restful but it helps clear your head.",
      }, { 
        name: "sleep",
        text: "You search around until you find a suitable place where you're least likely to be disturbed; making yourself as comfortable as possible before eventually drifting off. You awake some hours later, refreshed!"
      }
    ],


    actions: [
      {
        label: "Just a nap.",
        trigger: "part:nap"

      }, {
        label: "As long as I need!",
        trigger: "part:sleep"
      }, {
        label: "Nevermind",
        trigger: "cancel"
      }
    ]






    // Sleep
  }, {

    name: "rest",
    text: "Feeling tired, you decide it's time to get some sleep. \n\n Do you want a quick nap, or until you're rested?",
    pretext: "How many sleepies",
    require: "player.sleep < 60",


    parts: [
    	{ 
			name: "nap",
			text: "You find {@test} somewhere reletively comfy looking and curl up. It's not very restful but it helps clear your head.",
    	}, { 
    		name: "sleep",
    		text: "You search around until you find a suitable place where you're least likely to be disturbed; making yourself as comfortable as possible before eventually drifting off. You awake some hours later, refreshed!"
    	}
    ],


    actions: [
      {
        label: "Just a nap.",
        trigger: "part:nap"

      }, {
        label: "As long as I need!",
        trigger: "part:sleep"
      }, {
      	label: "Nevermind",
      	trigger: "cancel"
      }
    ]



    // Fap
  }, {

    name: "fap",
    text: "You whip off your pants and get ready to fap",
    pretext: "How many sleepies",

    parts: [
    	{
			name: "toy-cooch",
			text: "In need of a filling, you grab your favorite toy",
		}, { 
			name: "rub-cooch",
			text: "You get those fingers to work on your pretty pearl."
		}
    ],

    actions: [
      {
        label: "Fingers",
        trigger: "part:rub-cooch"

      }, {
        label: "Find a toy",
        trigger: "part:toy-cooch"
      }, {
      	label: "Now's not the best time...",
      	trigger: "cancel"
      }
    ]



    // Eat
  }, {


    name: "eat",
    text: "Your stomach growls",


    parts: [
    	{
			name: "inventory",
			text: "In need of a filling, you grab your favorite toy",
		}, { 
			name: "eatout",
			text: "You get those fingers to work on your pretty pearl."
		}
    ],


    actions: [
      {
        label: "Eat inventory",
        trigger: "part:inventory",
        requires: "player.hasfooditem"
      }, {
        label: "Find an eatery",
        trigger: "part:eatout",
        requires: "player.hasmoney"
      }, {
      	label: "Forage for something",
      	trigger: "scene:forage"
      }, {
      	label: "Maybe not",
      	trigger: "cancel"
      }

    ],



    // Forage
  }, {


    name: "forage",
    text: "You set out in search anything you might find useful. How long do you want to spend ?",


    actions: [
      {
        label: "Just an hour",
        trigger: "part:inventory",
        requires: "player.hasfooditem"
      }, {
        label: "The rest of the day",
        trigger: "player.eatout",
      }, {
      	label: "It can wait..",
      	trigger: "cancel"
      }

    ]



  }, {
  	


    name: "move",
    text: "in city you can travel by foot, sea, caravan, others? todo \n\n Where do you want to go?",



    actions: [
      {
        label: "Outside",
        trigger: "move:outside",
        requires: "player.hasfooditem"
      }, {
        label: "Market",
        trigger: "move:market",
      }, {
        label: "Residential",
        trigger: "move:city-north",
      }, {
        label: "The Wharf",
        trigger: "move:wharf",
      }, {
        label: "test",
        trigger: "move:test",
      }, {
        label: "Nevermind",
        trigger: "cancel",
      }

    ]






  },



];

