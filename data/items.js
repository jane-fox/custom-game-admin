
//currently unused
var item_data = [

  {

    label: "bread",
    text: "A loaf of bread",
    edible: true,
    equipable: false,
    
    pretext: "How many sleepies",


    parts: {

      label: "one",
      text: "you advance the scene",


    },

    actions: [
      {
        label: "Move",
        trigger: "move"
      }, {
        label: "Eat",
        trigger: "eat"
      }, 
      /*{
        label: "Fap",
        trigger: "fap"
      }, */
       {
        label: "Sleep",
        trigger: "rest"
      }, {
        label: "Forage",
        trigger: "forage"
      }


    ]



    // Sleep
  }, {

    label: "rest",
    text: "Feeling tired, you decide it's time to get some sleep. \n\n Do you want a quick nap, or until you're rested?",
    pretext: "How many sleepies",
    require: "player.sleep < 60",


    parts: [
    	{ 
			label: "nap",
			text: "You find somewhere reletively comfy looking and curl up. It's not very restful but it helps clear your head.",
    	}, { 
    		label: "sleep",
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

    label: "fap",
    text: "You whip off your pants and get ready to fap",
    pretext: "How many sleepies",

    parts: [
    	{
			label: "toy-cooch",
			text: "In need of a filling, you grab your favorite toy",
		}, { 
			label: "rub-cooch",
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
      }
    ]



    // Eat
  }, {


    label: "eat",
    text: "Your stomach growls",


    actions: [
      {
        label: "Eat inventory",
        trigger: "part:inventory",
        requires: "player.hasfooditem"
      }, {
        label: "Find an eatery",
        trigger: "player.eatout",
        requires: "player.hasmoney"
      }

    ],



    // Forage
  }, {


    label: "forage",
    text: "You set out in search anything you might find useful. How long do you want to spend ?",


    actions: [
      {
        label: "Just an hour",
        trigger: "part:inventory",
        requires: "player.hasfooditem"
      }, {
        label: "The rest of the day",
        trigger: "player.eatout"
      }

    ],



  },



];

