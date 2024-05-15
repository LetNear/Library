import React, { useState, useContext } from "react";
import {
  View,
  Text,
  ScrollView,
  Image,
  StyleSheet,
  SafeAreaView,
  Alert,
} from "react-native";
import Icon from "react-native-vector-icons/FontAwesome5";
import Button from "../Button"; // Make sure the path is correct

import { AuthContext } from "../AuthContext";
import HomeScreen from "./HomeScreen";
const MyImage = require("../../../../assets/favicon.png");

const ProductInfo = ({ route, navigation }) => {
  const { product } = route.params;
  const [isFavorite, setIsFavorite] = useState(false);
  const { user } = useContext(AuthContext);

  const toggleFavorite = () => setIsFavorite(!isFavorite);

  const addToCart = async () => {
    const cartData = {
      book_id: product.id,
      user_id: user.userID,
      quantity: 1,
    };

    const url = new URL("http://172.22.112.1/Library/api/cart/create");

    const response = await fetch(url, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(cartData),
    });

    if (response.ok) {
      console.log((await response.json()).data);
      navigation.navigate(HomeScreen);
    } else {
      const errorText = await response.text();
      Alert.alert(
        "Add to Cart Failed",
        errorText || "An error occurred while adding to cart. Please try again."
      );
    }
  };

  return (
    <SafeAreaView style={styles.safeAreaView}>
      <View style={styles.header}>
        <Icon
          name="arrow-left"
          size={24}
          onPress={() => navigation.goBack()}
          style={styles.icon}
        />
        <Text style={styles.headerTitle}>Details</Text>
      </View>
      <ScrollView showsVerticalScrollIndicator={false}>
        <View style={styles.imageContainer}>
          <Image source={MyImage} style={styles.productImage} />
        </View>
        <View style={styles.details}>
          <View style={styles.nameContainer}>
            <Text style={styles.productName}>{product.name}</Text>
            <Icon
              name={isFavorite ? "gratipay" : "heart"}
              size={25}
              onPress={toggleFavorite}
              style={styles.favoriteIcon}
            />
          </View>
          <Text style={styles.description}>{product.description}</Text>
          <Text style={styles.description}>Quantity: {product.qty}</Text>
          <Text style={styles.description}>Price: {product.price}</Text>
          <View style={styles.buttonContainer}>
            <Button title="Add To Cart" onPress={addToCart} />
          </View>
        </View>
      </ScrollView>
    </SafeAreaView>
  );
};

const styles = StyleSheet.create({
  safeAreaView: {
    flex: 1,
    backgroundColor: "#f0f0f5", // Light background
  },
  header: {
    flexDirection: "row",
    alignItems: "center",
    paddingVertical: 15,
    paddingHorizontal: 20,
    backgroundColor: "#6a1b9a", // Purple header
    paddingTop: 50, // Increased top padding
  },
  icon: {
    color: "white",
  },
  headerTitle: {
    fontSize: 20,
    fontWeight: "bold",
    color: "white",
    marginLeft: 20,
  },
  imageContainer: {
    justifyContent: "center",
    alignItems: "center",
    height: 280,
  },
  productImage: {
    height: 220,
    width: 220,
    resizeMode: "contain",
  },
  details: {
    paddingHorizontal: 20,
    paddingTop: 20,
    paddingBottom: 40,
    backgroundColor: "#ffffff", // White background for details section
    borderTopRightRadius: 20,
    borderTopLeftRadius: 20,
    shadowColor: "#000",
    shadowOffset: { width: 0, height: 2 },
    shadowOpacity: 0.1,
    shadowRadius: 4,
    elevation: 3,
    marginTop: 20,
  },
  nameContainer: {
    flexDirection: "row",
    justifyContent: "space-between",
    alignItems: "center",
    marginBottom: 10,
  },
  productName: {
    fontSize: 25,
    fontWeight: "bold",
    color: "#333",
  },
  favoriteIcon: {
    backgroundColor: "white",
    padding: 8,
    borderRadius: 25,
    shadowColor: "#000",
    shadowOffset: { width: 0, height: 2 },
    shadowOpacity: 0.1,
    shadowRadius: 4,
    elevation: 3,
  },
  description: {
    marginTop: 10,
    lineHeight: 22,
    fontSize: 16,
    color: "#666",
  },
  buttonContainer: {
    marginTop: 40,
    backgroundColor: "#6a1b9a", // Purple background for button container
    borderRadius: 10,
    paddingVertical: 10,
    paddingHorizontal: 20,
    alignItems: "center",
  },
});

export default ProductInfo;
