import { createBottomTabNavigator } from "@react-navigation/bottom-tabs";
import LoginScreen from "./LoginScreen";
import Icon from "react-native-vector-icons/FontAwesome5";


const Tab = createBottomTabNavigator();

const ButtomNav = () => {
  return (
    <Tab.Navigator
      screenOptions={({route}) => ({
        headerShown: false,
        tabBarIcon: ({ focused, color, size}) => {
          let iconName;

          if (route.name === 'LoginScreen') {
            iconName = focused
            ? 'home' : 'home';
          } else if (route.name === 'LoginScreen') {
            iconName = focused ? 'user-circle' : 'user-circle';
          } else if (route.name === 'LoginScreen Us') {
            iconName = focused? 'info-circle' : 'info-circle';
          } else if (route.name === 'LoginScreen') {
            iconName = focused? 'shopping-cart' : 'cart-alt';
          }

          return <Icon name={iconName} size={size} color={color} />;
        },
        tabBarActiveTintColor: 'green',
        tabBarInactiveTintColor: 'gray',
      })}>
    
      <Tab.Screen name="LoginScreen" component={LoginScreen} />
      <Tab.Screen name="LoginScreen" component={LoginScreen} />
      <Tab.Screen name="LoginScreen" component={LoginScreen} />
      <Tab.Screen name="ProLoginScreenfile" component={LoginScreen} />

    </Tab.Navigator>
  );
};

export default ButtomNav;
