import React, { useEffect, useState } from "react";
import {
  View,
  Text,
  StyleSheet,
  ScrollView,
  TouchableOpacity,
  Image,
} from "react-native";
import Icon from "react-native-vector-icons/FontAwesome5";
import AsyncStorage from "@react-native-async-storage/async-storage";

const MyImage = require("../../../../assets/favicon.png");

const HomeScreen = ({ navigation }) => {
  const [userDetails, setUserDetails] = useState(null);
  const [scentData, setScentData] = useState([]);

  useEffect(() => {
    getUserData();
    getDataFromDB();
    const unsubscribe = navigation.addListener("focus", getDataFromDB);
    return unsubscribe;
  }, [navigation]);

  const getUserData = async () => {
    const userData = await AsyncStorage.getItem("userData");
    if (userData) {
      setUserDetails(JSON.parse(userData));
    }
  };

  const getDataFromDB = async () => {
    const url = new URL("http://172.22.112.1/Library/api/books");
    const response = await fetch(url, {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
      },
    });
    const data = await response.json();
    setScentData(data.data);
  };

  const PlantCard = ({ data }) => (
    <TouchableOpacity
      onPress={() => navigation.navigate("ProductInfo", { product: data })}
      style={styles.card}
    >
      <View style={styles.imageContainer}>
        <Image source={MyImage} style={styles.productImage} />
      </View>
      <Text style={styles.productName}>{data.name}</Text>
      <Text style={styles.productPrice}>Php {data.price}</Text>
    </TouchableOpacity>
  );

  return (
    <View style={styles.container}>
      <ScrollView>
        <View style={styles.header}>
          <Icon
            name="sign-out-alt"
            style={styles.icon}
            onPress={() => navigation.navigate("LoginScreen")}
          />
          <Icon
            name="cart-plus"
            style={styles.icon}
            onPress={() => navigation.navigate("Cart")}
          />
        </View>
        <View style={styles.subContainer}>
          <Text style={styles.titleText}>
            Welcome to Library{" "}
            {userDetails?.fullname || userDetails?.displayName}
          </Text>
          <Text style={styles.subHead}>
            Discover your perfect scent with Library - where aromas inspire.
          </Text>
        </View>
        <View style={styles.productContainer}>
          {scentData.map((data) => (
            <PlantCard data={data} key={data.id} />
          ))}
        </View>
      </ScrollView>
    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: "#f0f0f5",
    paddingHorizontal: 10, // Added padding for container
  },
  header: {
    flexDirection: "row",
    justifyContent: "space-between",
    paddingHorizontal: 20,
    paddingVertical: 15,
    backgroundColor: "#6a1b9a",
  },
  subContainer: {
    padding: 20,
    backgroundColor: "#ffffff",
    borderBottomLeftRadius: 20,
    borderBottomRightRadius: 20,
    marginBottom: 20,
    shadowColor: "#000",
    shadowOffset: { width: 0, height: 2 },
    shadowOpacity: 0.1,
    shadowRadius: 4,
    elevation: 3,
  },
  productContainer: {
    flexDirection: "column", // Changed to column layout
    justifyContent: "center",
    paddingHorizontal: 10, // Adjusted padding for product container
  },
  card: {
    width: "100%", // Adjusted width to span full screen width
    marginVertical: 10,
    backgroundColor: "#ffffff",
    borderRadius: 10,
    padding: 15,
    alignItems: "center",
    shadowColor: "#000",
    shadowOffset: { width: 0, height: 2 },
    shadowOpacity: 0.1,
    shadowRadius: 4,
    elevation: 3,
  },
  imageContainer: {
    width: "100%",
    height: 120,
    justifyContent: "center",
    alignItems: "center",
    marginBottom: 10,
    borderRadius: 10,
    overflow: "hidden",
  },
  productImage: {
    width: "100%",
    height: "100%",
    resizeMode: "cover",
  },
  productName: {
    fontSize: 16,
    color: "#333",
    fontWeight: "600",
    marginBottom: 4,
    textAlign: "center",
  },
  productPrice: {
    fontSize: 14,
    color: "#6a1b9a",
  },
  titleText: {
    fontSize: 24,
    color: "#6a1b9a",
    fontWeight: "bold",
    textAlign: "center",
    marginBottom: 10,
  },
  subHead: {
    fontSize: 16,
    color: "#777",
    textAlign: "center",
    marginBottom: 20,
  },
  icon: {
    fontSize: 24,
    color: "#FFFFFF",
  },
});

export default HomeScreen;
